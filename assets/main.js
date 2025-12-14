// Sidebar toggle
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const navLinks = document.getElementById('navLinks');
    if (sidebar.classList.contains('extended')) {
        sidebar.classList.remove('extended');
        navLinks.style.display = 'none';
    } else {
        sidebar.classList.add('extended');
        navLinks.style.display = 'block';
    }
}

let menu = [];
let topPicks = [];

window.onload = async function() {
    // Fetch menu from backend
    const res = await fetch('../backend/menu.php');
    menu = await res.json();
    topPicks = menu.slice(0,4);
    // Render top picks
    const topPicksDiv = document.getElementById('topPicks');
    topPicks.forEach(item => {
        const card = document.createElement('div');
        card.className = 'menu-card';
        card.innerHTML = `<img src="../assets/${item.img}" alt="${item.name}" style="width:90px; border-radius:8px; margin-bottom:8px;">
            <div class="menu-title">${item.name}</div>
            <div class="menu-price">Rp${item.price.toLocaleString()}</div>
            <button class="btn" onclick="addToCart(${item.id})">Tambah</button>`;
        topPicksDiv.appendChild(card);
    });
    // Render menu grid
    const menuGrid = document.getElementById('menuGrid');
    menu.forEach(item => {
        const card = document.createElement('div');
        card.className = 'menu-card';
        card.innerHTML = `<img src="../assets/${item.img}" alt="${item.name}" style="width:90px; border-radius:8px; margin-bottom:8px;">
            <div class="menu-title">${item.name}</div>
            <div class="menu-price">Rp${item.price.toLocaleString()}</div>
            <button class="btn" onclick="addToCart(${item.id})">Tambah</button>`;
        menuGrid.appendChild(card);
    });
    // Tampilkan keranjang jika ada isi
    showCart();
}

// Cart logic
let cart = [];
async function fetchCart() {
    try {
        const res = await fetch('../backend/cart.php?action=get');
        if(res.ok) {
            cart = await res.json();
            return true;
        }
    } catch(e) {}
    cart = JSON.parse(localStorage.getItem('cart')||'[]');
    return false;
}
async function addToCart(id) {
    const item = menu.find(m => m.id === id);
    // Cek login dengan coba POST ke backend, jika gagal fallback ke localStorage
    let backendOK = false;
    try {
        const resp = await fetch('../backend/cart.php?action=add', {
            method: 'POST',
            headers: {'Content-Type':'application/x-www-form-urlencoded'},
            body: `menu_id=${id}&qty=1&notes=`
        });
        if(resp.ok) {
            alert('Ditambahkan ke keranjang!');
            backendOK = true;
        }
    } catch(e) {}
    if(!backendOK) {
        // fallback localStorage (jika user belum login)
        const found = cart.find(c => c.id === id);
        if(found) found.qty++;
        else cart.push({...item, qty:1, notes:''});
        localStorage.setItem('cart', JSON.stringify(cart));
    }
    // Selalu tampilkan keranjang setelah tambah
    showCart();
}
async function showCart() {
    await fetchCart();
    const popup = document.getElementById('cartPopup');
    if(cart.length === 0) { popup.style.display = 'none'; localStorage.removeItem('cart'); return; }
    let html = '<div class="cart-title">Keranjang</div>';
    cart.forEach((item) => {
        const uniqueId = item.id || item.menu_id;
        html += `<div style='margin-bottom:12px;'>
            <b>${item.name}</b> (Rp${item.price.toLocaleString()})<br>
            <input type='number' min='1' value='${item.qty}' style='width:48px;' onchange='updateQtyById(${uniqueId},this.value,event)'>
            <button onclick='removeCartById(${uniqueId})' style='margin-left:8px;'>🗑️</button><br>
            <input type='text' placeholder='Catatan' value='${item.notes||''}' onchange='updateNotesById(${uniqueId},this.value)' style='width:90%'>
            <div style='color:#174ea6; font-weight:bold;'>Subtotal: Rp${(item.price*item.qty).toLocaleString()}</div>
        </div>`;
    });
    const total = cart.reduce((a,b)=>a+b.price*b.qty,0);
    html += `<div class='cart-total'>Total: Rp${total.toLocaleString()}</div>`;
    html += `<button class='btn' style='width:100%;margin-top:12px;' onclick='window.location=\"checkout.php\"'>Bayar</button>`;
    popup.innerHTML = html;
    popup.style.display = 'block';
    localStorage.setItem('cart', JSON.stringify(cart));
}
async function updateQtyById(uniqueId, val, event) {
    let qty = Math.max(1, parseInt(val)||1);
    if(event && event.target) {
        qty = Math.max(1, parseInt(event.target.value)||1);
    }
    const idx = cart.findIndex(item => (item.id||item.menu_id) == uniqueId);
    if(idx === -1) return;
    if(cart[idx].id) {
        await fetch('../backend/cart.php?action=add', {
            method: 'POST',
            headers: {'Content-Type':'application/x-www-form-urlencoded'},
            body: `menu_id=${cart[idx].menu_id||cart[idx].id}&qty=${qty}&notes=${encodeURIComponent(cart[idx].notes||'')}`
        });
        await fetchCart();
    } else {
        cart[idx].qty = qty;
        localStorage.setItem('cart', JSON.stringify(cart));
    }
    showCart();
}
async function updateNotesById(uniqueId, val) {
    const idx = cart.findIndex(item => (item.id||item.menu_id) == uniqueId);
    if(idx === -1) return;
    cart[idx].notes = val;
    if(cart[idx].id) {
        await fetch('../backend/cart.php?action=add', {
            method: 'POST',
            headers: {'Content-Type':'application/x-www-form-urlencoded'},
            body: `menu_id=${cart[idx].menu_id||cart[idx].id}&qty=${cart[idx].qty}&notes=${encodeURIComponent(val)}`
        });
        await fetchCart();
    } else {
        localStorage.setItem('cart', JSON.stringify(cart));
    }
}
async function removeCartById(uniqueId) {
    const idx = cart.findIndex(item => (item.id||item.menu_id) == uniqueId);
    if(idx === -1) return;
    if(cart[idx].id) {
        await fetch('../backend/cart.php?action=remove', {
            method: 'POST',
            headers: {'Content-Type':'application/x-www-form-urlencoded'},
            body: `cart_id=${cart[idx].id}`
        });
    } else {
        cart.splice(idx,1);
        localStorage.setItem('cart', JSON.stringify(cart));
    }
    showCart();
}

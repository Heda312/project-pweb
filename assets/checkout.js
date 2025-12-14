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
async function renderSummary() {
    await fetchCart();
    const div = document.getElementById('checkoutSummary');
    if(!cart || cart.length===0) { div.innerHTML = '<b>Keranjang kosong.</b>'; return; }
    let html = '';
    let total = 0;
    cart.forEach(item => {
        html += `<div style='margin-bottom:8px;'>${item.name} x${item.qty} <span style='float:right;'>Rp${(item.price*item.qty).toLocaleString()}</span><br><small>Catatan: ${item.notes||'-'}</small></div>`;
        total += item.price*item.qty;
    });
    html += `<hr><div style='font-weight:bold;'>Total: <span style='float:right;'>Rp${total.toLocaleString()}</span></div>`;
    div.innerHTML = html;
}
window.onload = function() {
    renderSummary();
    document.getElementById('checkoutForm').onsubmit = function(e) {
        e.preventDefault();
        const type = document.getElementById('paymentType').value;
        if(!type) return;
        const total = cart.reduce((a,b)=>a+b.price*b.qty,0);
        let method = '', code = '';
        if(type==='wallet') { method='OVO/DANA/Gopay'; code='WLT'+Math.floor(Math.random()*90000+10000); }
        if(type==='bank') { method='Bank BCA/BNI/BRI'; code='BNK'+Math.floor(Math.random()*90000+10000); }
        if(type==='qris') { method='QRIS'; code='QRS'+Math.floor(Math.random()*90000+10000); }
        document.getElementById('paymentResult').innerHTML = `<b>Harga:</b> Rp${total.toLocaleString()}<br><b>Metode:</b> ${method}<br><b>Kode Bayar:</b> <span style='color:#2563eb;'>${code}</span>`;
        localStorage.removeItem('cart');
        cart = [];
    }
}
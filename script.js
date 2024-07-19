function calculateTotal(event) {
    event.preventDefault();

    const menuPrices = {
        es_tea_sweet: 3000,
        es_tea_plain: 2000,
        es_lemon_tea: 5000,
        es_tea_jumbo: 4000
    };

    const quantity = document.getElementById('quantity').value;
    const menu = document.getElementById('menu').value;
    const total = quantity * menuPrices[menu];

    document.getElementById('totalDisplay').textContent = `Total Tagihan: Rp${total}`;
}

document.getElementById('orderForm').addEventListener('submit', function (event) {
    event.preventDefault();
    const formData = new FormData(this);

    const jsonObject = {};
    formData.forEach((value, key) => {
        jsonObject[key] = value;
    });

    fetch('process_order.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(jsonObject)
    })
        .then(response => response.text())
        .then(data => {
            document.getElementById('orderForm').reset();
            document.getElementById('totalDisplay').textContent = '';
            document.getElementById('confirmation').textContent = data;
        })
        .catch(error => console.error('Error:', error));
});

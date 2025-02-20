// Validation de formulaire
document.getElementById('payment-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Empêche l'envoi du formulaire

    const montant = document.getElementById('amount').value;
    const date = document.getElementById('date').value;

    if (!montant || !date) {
        alert("Veuillez remplir tous les champs !");
    } else {
        alert("Paiement effectué avec succès !");
    }
});

// Menu mobile
document.getElementById('menu-btn').addEventListener('click', function() {
    const menu = document.getElementById('menu');
    menu.style.display = (menu.style.display === 'none' || menu.style.display === '') ? 'block' : 'none';
});
// Mise à jour dynamique du texte
document.getElementById('update-text').addEventListener('click', function() {
    document.getElementById('info-text').textContent = "Le texte a été mis à jour!";
});

// Effet de survol
document.getElementById('hover-btn').addEventListener('mouseover', function() {
    this.style.backgroundColor = "green";
});

document.getElementById('hover-btn').addEventListener('mouseout', function() {
    this.style.backgroundColor = "";
});

// Animation au scroll
window.addEventListener('scroll', function() {
    const element = document.getElementById('animated-element');
    if (window.scrollY > 100) {
        element.style.display = "block";
    }
});

// Chargement dynamique des paiements (Exemple d'AJAX)
function loadPayments() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'load_payments.php', true);

    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById('payment-list').innerHTML = xhr.responseText;
        } else {
            alert('Erreur lors du chargement des paiements.');
        }
    };

    xhr.send();
}

window.onload = loadPayments;  // Charger les paiements dès que la page est prêt
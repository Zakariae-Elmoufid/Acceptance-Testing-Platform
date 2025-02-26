// Fonction pour basculer l'affichage des sections selon le rôle
function toggleSections() {
    const roleSelect = document.getElementById('role_id');
    const candidateSection = document.getElementById('candidate-section');
    const otherRolesSection = document.getElementById('other-roles-section');
    
    // ID du rôle candidat (à ajuster selon votre base de données)
    const candidateRoleId = "1"; // Supposons que l'ID du rôle "candidat" est 1
    
    if(roleSelect.value == candidateRoleId) {
        candidateSection.style.display = "block";
        otherRolesSection.style.display = "none";
    } else {
        candidateSection.style.display = "none";
        otherRolesSection.style.display = "block";
    }
}

// Exécuter la fonction au chargement de la page pour initialiser l'affichage
document.addEventListener('DOMContentLoaded', function() {
    toggleSections();
    
    // Ajouter l'écouteur d'événements pour le changement de rôle
    const roleSelect = document.getElementById('role_id');
    if (roleSelect) {
        roleSelect.addEventListener('change', toggleSections);
    }
});
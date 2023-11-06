

export function select() {

    // Sélectionnez la liste déroulante par son ID
    const subjectSelect = document.getElementById("subjectSelect");

    subjectSelect.addEventListener("change", function() {

        // Crée une variable selectedOption qui contient la référence à l'option actuellement sélectionnée dans la liste déroulante
        const selectedOption = this.options[this.selectedIndex];
        
        // Supprime la classe "selected" de l'option précédemment sélectionnée
        const prevSelectedOption = this.querySelector(".selected");
        if (prevSelectedOption) {
            prevSelectedOption.classList.remove("selected");
        }
        
        // Applique la classe "selected" à l'option sélectionnée
        selectedOption.classList.add("selected");

    });

}
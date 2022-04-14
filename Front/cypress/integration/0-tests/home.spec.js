describe("Add figurine to basket", () => {
    it("Add figurine to basket", () => {
      cy.visit("http://localhost:3000"); // go to the site
      cy.contains("Alien Googah").click(); // select a figurine
      cy.get("#productQuantity").contains("70"); // add quantity
      cy.get("#add").click(); // Add figurine to the barket
      cy.wait(5000);
      cy.get("#saveSuccess").contains("Enregistré dans le panier"); // Get adding success
      cy.get("#return").click(); // Return on home page
    });

    it("Remove figurine from basket", () => {
        cy.visit("http://localhost:3000"); // go to the site
        cy.get("#goToBasket").click(); // go to the basket
        cy.get("#remove-0").click(); // delete first element in the basket
        
        // For the future check that element 0 is our element Alien googah
        /*const toto = cy.contains("Alien Googah").then(id => {
            console.log("id", id);
        });
        console.log("toto ", toto)*/
        /*for (i=0; i<; i++) {

        }*/
        //cy.get("#productIndex-")
        //cy.contains("Alien Googah").click(); // Remove figurine to the barket
        //cy.wait(5000);
        //cy.get("#saveSuccess").contains("Enregistré dans le panier"); // Get adding success
        //cy.get("#return").click(); // Return on home page
    });
});
describe("Add figurine to barket", () => {
    it("Add figurine", () => {
      cy.visit("http://localhost:3000"); // go to the site
      cy.contains("Alien Googah").click(); // select a figurine
      cy.get("#productQuantity").contains("70"); // 
      cy.get("#add").click(); // Add figurine to the barket
      cy.wait(5000);
      cy.get("#saveSuccess").contains("Enregistré dans le panier"); // Get adding success
      cy.get("#return").click(); // Return on home page
    });
});
  
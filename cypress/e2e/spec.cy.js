describe('Sitio MVC - Página de inicio', () => {
  it('Carga correctamente', () => {
    cy.visit('http://localhost:3000/');
    cy.contains('Inicio'); // Cambia 'Inicio' por texto real visible en tu página
  });
});
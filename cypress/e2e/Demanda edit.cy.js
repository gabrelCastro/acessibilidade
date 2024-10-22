
describe('template spec', () => {
  it('Editando demanda', () => {
    cy.visit('http://127.0.0.1:8000/')
    cy.get('#email').type("emailteste@teste.com")
    cy.get('#password').type("12345678")
    cy.contains('Log in').click()

    cy.get('input[name="password"]').eq(0).type('12345678')
    cy.get('.button').eq(0).click()
    cy.contains('a', 'Realizar verificação').first().click()
    cy.get('[name="opcao"][value="1"]').click()
    cy.get('#botao_submition').click()
  })
})
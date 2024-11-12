Cypress.on("uncaught:exception", (err, runnable) => {
  if (err.message.includes("Cannot read properties of null (reading 'addEventListener')")) {
      return false;
  }
  if (err.message.includes("validateForm is not defined")) {
    return false;
  }
});

describe('Edição da demanda', () => {
  it('Confirmando todas', () => {
    cy.visit('http://127.0.0.1:8000/')
    cy.get('#email').type("emailteste@teste.com")
    cy.get('#password').type("12345678")
    cy.contains('Log in').click()
    cy.get('input[name="password"]').eq(0).type('12345678')
    cy.get('.button').eq(0).click()

    cy.contains('a', 'Realizar verificação').each(($link, index, $list) => {
      cy.wrap($link).click(); // Clica no link
      cy.get('[name="opcao"][value="1"]').click(); // Clica na opção
      cy.get('#botao_submition').click(); // Clica no botão de envio
    });
  })

  it('Confirmando todas', () => {
    cy.visit('http://127.0.0.1:8000/')
    cy.get('#email').type("emailteste@teste.com")
    cy.get('#password').type("12345678")
    cy.contains('Log in').click()
    cy.get('input[name="password"]').eq(1).type('12345678')
    cy.get('.button').eq(0).click()

    cy.contains('a', 'Realizar verificação').each(($link, index, $list) => {
      cy.wrap($link).click(); // Clica no link
      cy.get('[name="opcao"][value="2"]').click(); // Clica na opção
      cy.get('#botao_submition').click(); // Clica no botão de envio
    });
    
  })
})
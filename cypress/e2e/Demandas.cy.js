Cypress.on("uncaught:exception", (err, runnable) => {
  if (err.message.includes("Cannot read properties of null (reading 'addEventListener')")) {
      return false;
  }
});


describe('Criação e acesso de uma demanda', () => {
  it('Criação de uma nova demanda', () => {
    cy.visit('http://127.0.0.1:8000/')
    cy.get('[data-cy="emailLogin"]').type("emailteste@teste.com")
    cy.get('[data-cy="senhaLogin"]').type("12345678")
    cy.get('[data-cy="butaoLogin"]').click()

    cy.get('[data-cy=cadastrar_demanda]').click()
    cy.get('[data-cy=nome_demanda]').type('Demanda teste')
    cy.get('[data-cy=descricao_demanda]').type('DESCRIÇÃO DESCRIÇÃO DESCRIÇÃO DESCRIÇÃO DESCRIÇÃO DESCRIÇÃO DESCRIÇÃO DESCRIÇÃO DESCRIÇÃO DESCRIÇÃO DESCRIÇÃO DESCRIÇÃO ')
    cy.get('[data-cy=url]').type('teste.com')
    cy.get('[data-cy=nome_pagina]').type('SITE TESTE')
    cy.get('[data-cy=botao_pagina]').click()
    cy.get('[data-cy=senha]').type('12345678')
    cy.get('[data-cy=senha_confirma]').type('12345678')
    cy.get('[data-cy=botao_final]').click()

    cy.get('[data-cy=demanda_teste]').should('contain', 'Demanda teste')
  })

  it.only('Acessando uma demanda com senha', () => {
    cy.visit('http://127.0.0.1:8000/')
    cy.get('[data-cy="emailLogin"]').type("emailteste@teste.com")
    cy.get('[data-cy="senhaLogin"]').type("12345678")
    cy.get('[data-cy="butaoLogin"]').click()

    cy.get('[data-cy=senha_demanda]').eq(0).type('12345678')
    console.log('chegou na senha')
    if (cy.get('[data-cy=butao_demanda]').first()) {
      console.log('chegou no primeiro botão')
      cy.get('[data-cy=butao_demanda]').first().click()
     } else {
       console.log('Não existe um botão com a classe button no código')
     }
     if(cy.get('[data-cy=botao_finalizar]')){
        console.log('Chegou na pagina da demanda')
     }
  })
})
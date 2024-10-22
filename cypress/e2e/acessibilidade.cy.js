describe('Testes básicos', () => {
  let email;

  it('Cadastrar', () => {
    const timestamp = new Date().getTime();
    email = `emailTeste${timestamp}@teste.com`;

    cy.visit('http://127.0.0.1:8000/register')
    cy.get('[data-cy="nameRegistro"]').type(`Fulano Ciclano${timestamp}`)
    cy.get('[data-cy="emailRegistro"]').type(email)
    cy.get('[data-cy="senhaRegistro"]').type("12345678")
    cy.get('[data-cy="senhaConfirmRegistro"]').type("12345678")
    cy.get('[data-cy="butaoRegistro"]').click()

    cy.get('[data-cy="sair"]')
  })

  it('Login', () =>{
    cy.visit('http://127.0.0.1:8000/login')
    cy.get('[data-cy="emailLogin"]').type(email)
    cy.get('[data-cy="senhaLogin"]').type("12345678")
    cy.get('[data-cy="butaoLogin"]').click()

    cy.get('[data-cy="sair"]')
  })
})
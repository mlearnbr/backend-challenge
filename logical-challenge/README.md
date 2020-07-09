# Desafio lógico da mLearn

Este diretório faz parte do desafio lógico proposto pela mLearn.

Como foi de livre escolha a linguagem da resolução do desafio, optei pela utilização do **JavaScript**.

A proposta do desafio é retornar a diferença entre a soma das diagonais de uma matriz quadrada.

Como não foi definido se a matriz seria gerada randomicamente ou se seria definida pelo usuário, foram abordadas **duas propostas**, uma na qual é fornecida uma matrix  e uma na qual a matriz é gerada por um método auxiliar.

## Utilização do script

1. Instancie a classe matrixHandle 
```javascript
const matrixHandle = new MatrixHandle();
```
2. Utilize o método setMatrix passando como parâmetro uma matriz quadrada de números inteiros ou utilize o método generateRandomMatrix passando como parâmetro um número inteiro para especificar seu tamanho.
```javascript
//Especificando sua própria matriz
matrixHandle.setMatrix([[8, 3, -28], [6, 87, -435], [98, 55, 188]]);
```
ou
```javascript
//Gerando uma matriz randomicamente
const matrixSize = 3;
matrixHandle.generateRandomMatrix(dimension);
```
2. Chame o método matrixHandle.getDiffBetweenDiagonals()
```javascript
matrixHandle.getDiffBetweenDiagonals();
```
## Métodos
#### **Construtor**
**Recebe**: não recebe nada
**Retorna**: void
#### **setMatrix**
**Recebe**: matriz quadrada de inteiros (obrigatório)
**Retorna**: void
#### **checkIfMatrixIsValid**
**Recebe**: matriz quadrada de inteiros (obrigatório)
**Retorna**: objeto
#### **generateRandomMatrix**
**Recebe**: número inteiro positivo (obrigatório)
**Retorna**: void
#### **getMatrix**
**Recebe**: não recebe nada
**Retorna**: matriz
#### **getDiffBetweenDiagonals**
**Recebe**: não recebe nada
**Retorna**: Resultado inteiro entre a diferença das duas diagonais da matriz
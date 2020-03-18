// briefing: Função para calcular a subtração entre os somatório da
//           diagonal principal pela diagonal secundária.
// input: Matrix - Matriz Quadrada, contendo somente valores númericos
// output: Objeto contendo o resultado e uma string de erro, caso haja.
//          {
//              result: valor númerico resultante da diferença do somátorio das diagonais
//              error: Caso contenha um erro, uma string informando o motivo.
//          }
function calculaDiagonais(matrix) {
  let output = {
    result: null,
    error: null
  };
  let isMatrix = Array.isArray(matrix);
  let isSquare = true;
  let isAllNumeric = true;
  let sumDiagonalPri = 0;
  let sumDiagonalSec = 0;

  if (isMatrix) {
    //Calcula a quantidade de linhas da matriz
    let numRows = matrix.length;
    //Executa para cada Linha
    matrix.forEach((row, rowNum) => {
      isMatrix &= Array.isArray(row);
      if (isMatrix) {
        //Verifica se a matrix é quadrada
        isSquare &= numRows == row.length;
        //Executa para cada coluna
        row.forEach((col, colNum) => {
          //Verifica se é um número
          isAllNumeric &= !isNaN(col);
          if (isAllNumeric) {
            sumDiagonalPri += rowNum == colNum ? col : 0;
            sumDiagonalSec += rowNum + colNum == numRows - 1 ? col : 0;
          }
        });
      }
    });
  }
  if (!isMatrix) output.error = 'Não é uma Matriz';
  if (!isSquare) output.error = 'Matriz não é quadrada';
  if (!isAllNumeric) output.error = 'Matriz contém itens não numéricos';

  if (output.error == null) output.result = sumDiagonalPri - sumDiagonalSec;
  return output;
}

// briefing: Teste do cálculo da função calculaDiagonais
// input: matrix - Matriz Quadrada, contendo somente valores númericos
//        result - Resultado esperado da função
// output: objeto contendo o resultado do teste
//          {
//              matrix: Matriz trabalhada
//              result: booleano falando se o teste teve ou não sucesso
//              expected: Valor Esperado da função
//              return: Valor retornado
//              error: Caso contenha um erro, uma string informando o motivo.
//          }
function test_calculaDiagonais(matrix, expected) {
  let testResult = calculaDiagonais(matrix);
  return {
    matrix,
    result: testResult.result == expected,
    expected,
    return: testResult.result,
    error: testResult.error
  };
}

// briefing: Executa suíte de testes
function runTestSuite() {
  let testResult = [];
  test.forEach(elem => {
    testResult.push(test_calculaDiagonais(elem.matrix, elem.result));
  });
  return testResult;
}

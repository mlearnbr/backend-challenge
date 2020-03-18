// briefing: Converte os itens de um Text Área em uma Matrix
// output: Matriz dos dados contidos na Text Area
function matrixConvert() {
  var textArea = document.getElementById('textMatrix');
  var rows = textArea.value.replace(/\r\n/g, '\n').split('\n');
  let convertedMatrix = [];
  if (Array.isArray(rows)) {
    rows.forEach((elem, index) => {
      cols = elem.split(',');
      convertedMatrix[index] = cols.map(val => Number(val));
    });
  }
  return convertedMatrix;
}

// briefing: Imprime na tela os resultados do cálculo
function printResults(result) {
  if (result.error == null) {
    document.getElementById('TextResult').innerHTML =
      'O resultado da diferença da soma das Diagonais é: ' + result.result;
  } else {
    document.getElementById('TextResult').innerHTML = 'Erro: ' + result.error;
  }
}

// briefing: Imprime na tela os resultados dos testes Automáticos
function printSuiteTestsResults(result) {
  let TestNum = 1;
  result.forEach(elem => {
    let node = document.createElement('h5');
    let textnode = document.createTextNode('Teste Nº' + TestNum);
    node.appendChild(textnode);
    document.getElementById('SuiteResults').appendChild(node);
    //Imprime a Matriz
    if (Array.isArray(elem.matrix))
      elem.matrix.forEach(row => {
        let stringRow = '';
        row.forEach(col => {
          stringRow += col + ',';
        });
        node = document.createElement('p');
        node.setAttribute('class', 'matrix');
        textnode = document.createTextNode(stringRow);
        node.appendChild(textnode);
        document.getElementById('SuiteResults').appendChild(node);
      });
    // Imprime o Resultado
    node = document.createElement('p');
    if (elem.result) {
      node.setAttribute('class', 'success');
    } else {
      node.setAttribute('class', 'fail');
    }
    textnode = document.createTextNode(
      'Esperado: ' + elem.expected + ' - Retornado: ' + elem.return
    );
    node.appendChild(textnode);
    document.getElementById('SuiteResults').appendChild(node);
    //Caso tenha erro, imprime ele
    if (elem.error != null) {
      node = document.createElement('p');
      node.setAttribute('class', 'warning');
      textnode = document.createTextNode('Erro: ' + elem.error);
      node.appendChild(textnode);
      document.getElementById('SuiteResults').appendChild(node);
    }
    TestNum++;
  });
}

// briefing: Realiza os cálculos das diagonais
function makeCalc() {
  let matrix = matrixConvert();
  let result = calculaDiagonais(matrix);
  printResults(result);
}

// briefing: Realiza os cálculos da suíte de testes
function executeTestSuite() {
  let result = runTestSuite();
  printSuiteTestsResults(result);
}

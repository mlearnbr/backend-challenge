let $ = document.querySelector.bind(document);

let btnGerarMatriz = $("#btnGerarMatriz");
let divLog = $("#log");
let inputTam = $("#tam");

btnGerarMatriz.addEventListener('click', () => somaMatriz(inputTam.value));
/**
 * Função que calcula a subtração entre a soma dos valores de uma matriz quadrada
 * @param tam Indica o número de linhas e colunas da matriz
 */
function somaMatriz(tam){

    if(isNaN(parseInt(tam))){
        alert('O valor informado não é um número inteiro. Por favor informe um número inteiro.');
        inputTam.value = 0;
        return 0;
    }

    if(tam > 10){
        alert('Por motivos de performace, informe um valor menor que 10.');
        return 0;
    }

    let matriz = [];
    let somaD1 = 0;
    let somaD2 = 0;
    let sLog = ' <h3> Resultado: </h3>Matriz: <br>';

    /** Cria a matriz */
    for(let i = 0; i < tam; i++){
        matriz[i] = [];
        for (let j = 0; j < tam; j++){
            matriz[i][j] = (Math.floor(Math.random() * 10));
            sLog += ` ${matriz[i][j]} `;
        }
        sLog += '<br>'
    }

    /** Realiza a soma dos valores das diagonais */
    for(let i = 0; i < tam; i++){
        for (let j = 0; j < tam; j++){
            if(j == i)
                somaD1 += matriz[i][j];
            if(j+i == tam-1)
                somaD2 += matriz[i][j];
        }
    }

    sLog += `<br> Soma diagonal principal: ${somaD1} <br> Soma diagonal secundária: ${somaD2} <br> Diferença entre as somas (${somaD1}-${somaD2}) = <span style="font-weight: 600">${somaD1-somaD2}</span>`;
    
    divLog.innerHTML= sLog;
}
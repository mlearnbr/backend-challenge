/**
 * Função que retorna a subtração entre a soma dos valores de uma matriz quadrada
 * @param int tam Indica o número de linhas e colunas da matriz
 * @return int
 */
function somaMatriz(tam){

    let matriz = [];
    let somaD1 = 0;
    let somaD2 = 0;
    let sLog = ' Matriz: \n';

    /** Cria a matriz */
    for(let i = 0; i < tam; i++){
        matriz[i] = [];
        for (let j = 0; j < tam; j++){
            matriz[i][j] = (Math.floor(Math.random() * 10));
            sLog += ` ${matriz[i][j]} `;
        }
        sLog += '\n'
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

    sLog += `\n Soma diagonal principal: ${somaD1} \n Soma diagonal secundária: ${somaD2} \n Diferença entre as somas ${somaD1-somaD2}`;

    console.log(sLog);

    return (somaD1-somaD2);

}
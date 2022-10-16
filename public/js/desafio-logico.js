/**
 * Recebe uma matriz como parâmetro e retorna a diferença entre as diagonais
 * @param {*} matriz Uma matriz de números inteiros ou vetor de strings
 * @returns Diferença entre a soma de suas diagonais.
 */
function diferencaDiagonal(matriz = []) {
    if (!matriz.length) {
        return 0;
    }

    let diagEsq = 0;
    let diagDir = 0;

    for (let linha = 0; linha < matriz.length; linha++) {
        if (matriz[linha].length != matriz.length) {
            return 'Esta matriz não é quadrada';
        }

        diagEsq += parseInt(matriz[linha][linha]);
        diagDir += parseInt(matriz[linha][matriz[linha].length - 1 - linha]);
    }

    return diagEsq - diagDir;
}
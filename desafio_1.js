// Declaração da Matriz
let matriz = [[1, 2, 3], [4, 5, 6], [9, 8, 9]];
//Verifico o tamanho da matriz
const length = matriz.length;
//Inicio as diagonais 1 e 2 com zero
let diagonal1 = 0, diagonal2 = 0;
//Faço um loop for para percorrer a matriz e encontrar as diagonais 1 e 2
for (let i = 0; i < matriz.length; i++) {
    // Atribuo a variável diagonal1 o calculando a diagonal primária.
    diagonal1 += matriz[i][i];
    // Invertendo a segunda dimensão da matriz, a variável diagonal2 recebe o calculo da inversão.
    diagonal2 += matriz[length - 1 - i][i];
}
//mostrando resultado no console.log()
console.log(diagonal1 - diagonal2);
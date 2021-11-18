const matrix = [
    [1, 2, 3],
    [4, 5, 6],
    [9, 8, 9]
];

const matrix2 = [
    [9, 2, 3, 6],
    [4, 5, 7, 1],
    [2, 2, 8, 7],
    [4, 5, 4, 3]
];

const getDiagonalLeft = (matrix) => {
    let linha = 0;
    let coluna = 0;
    const diagL = []
    for (let index = 0; index < matrix.length; index += 1) {
        diagL.push(matrix[linha][coluna]);
        linha += 1
        coluna += 1
    }
    return diagL;
}

const getDiagonalRight = (matrix) => {
    let linha = 0;
    let coluna = matrix.length - 1;
    const diagR = []
    for (let index = 0; index < matrix.length; index += 1) {
        diagR.push(matrix[linha][coluna])
        linha += 1
        coluna -= 1
    }
    return diagR;
}

const differenceOfSumTheSquareDiagonals = (matrix) => {
    const diagL = getDiagonalLeft(matrix);
    const diagR = getDiagonalRight(matrix);

    const sumDiagL = diagL.reduce((pre, curr) => pre + curr, 0);
    const sumDiagR = diagR.reduce((pre, curr) => pre + curr, 0);

    return sumDiagL - sumDiagR;
}

console.log(differenceOfSumTheSquareDiagonals(matrix));
console.log(differenceOfSumTheSquareDiagonals(matrix2));

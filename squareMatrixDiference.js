const prompt = require('prompt-sync')();

const matrixElements = [];
let sideLength = 0;
const getData = () => {
    sideLength = parseInt(prompt('Please, type the side length of the square matrix: '), 10);
    for (let index = 0; index < sideLength; index += 1) {
        const matrixLine = [];
        for (let ind = 0; ind < sideLength; ind += 1) {
            const element = parseInt(
                prompt(`Please, type the value of the element ${ind} from line ${index}: `), 10);
            matrixLine.push(element);
        }
        matrixElements.push(matrixLine);
    }
}

const getSumDiference = () => {
    let leftDiagonalSum = 0;
    let rightDiagonalSum = 0;
    let movePointer = sideLength - 1;
    for (let index = 0; index < sideLength; index += 1) {
        for (let ind = 0; ind < sideLength; ind += 1) {
            if (index === ind) {
                leftDiagonalSum += matrixElements[index][ind];
                break;
            }
        }
        rightDiagonalSum += matrixElements[index][movePointer];
        movePointer -= 1;
    }
    console.log(leftDiagonalSum, rightDiagonalSum);
    return leftDiagonalSum - rightDiagonalSum;
}

getData();
console.table(`The diference between left and right diagonals is ${getSumDiference()}.`);
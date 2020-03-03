// 1 2 3
// 4 5 6
// 9 8 9

const entrada1 = [1, 2, 3]
const entrada2 = [4, 5, 6]
const entrada3 = [9, 8, 9]

let direita   = 0
let esquerda  = 0
let resultado = 0

const subtraiDiagonais = (...matriz) =>{
    matriz.forEach((vl, ind) => {
        //soma direita
        vl.forEach((v, i) => {
            if(ind === i) direita += v 
        })
        //soma esquerda
        vl.reverse().forEach((v, i) => {
            if(ind === i) esquerda += v 
        })
    })

    console.log(direita - esquerda)

}

subtraiDiagonais(entrada1, entrada2, entrada3)
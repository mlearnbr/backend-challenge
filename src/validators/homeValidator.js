const check = require('express-validator').check;

module.exports = {
    postRules:[
        check('matrix')
            .exists().withMessage("Por favor informa uma matriz quadrada")
            .custom((matrix) => {
                return new Promise((resolve, reject) => {
                    const lengthMatrix = matrix.length;                    
                    matrix.map(mat => {
                        if (mat.length != lengthMatrix){
                            reject();
                        }
                    })
                    resolve();                    
                });                
            }).withMessage("A matriz não é quadrada, favor nformar uma outra matriz")
    ]
};

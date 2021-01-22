exports.get = (req, res, next) => {
    res.status(200).send('utiliza a rota post');
};

exports.post = (req, res, next) => {
    try {
        const { body } = req;
        const { matrix } = body;
        
        let lengthMatrix = matrix.length;                    
        let diagonalLeftToRight = 0;
        let diagonalRightToLeft = 0;
        
        for(let i = 0; i < matrix.length; i++){        
            diagonalLeftToRight = diagonalLeftToRight + matrix[i][i];
            diagonalRightToLeft = diagonalRightToLeft + matrix[i][--lengthMatrix];
        }

        const diff = diagonalLeftToRight - diagonalRightToLeft;

        
        return res.json({
            success: 200,
            data: `A diferença da matriz é ${diff}` 
        });
    } catch (e) {
        console.log(e)
        return res.json({
            error: 400,
            data: 'Não foi possível identificar a diferença da matriz.'
        });
    }
}
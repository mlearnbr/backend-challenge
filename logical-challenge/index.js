class MatrixHandle {
    checkIfMatrixIsValid(matrix) {
        try {
            if (!Array.isArray(matrix)) throw new Error('Tipo de dado inválido')
            if (matrix.length === 0) throw new Error('Matriz vazia')
            for (let i = 0; i < matrix.length; i++) {
                const row = matrix[i]
                if (row.length !== matrix.length) {
                    throw new Error('Matriz não é quadrada')
                }
                for (let j = 0; j < row.length; j++) {
                    if (!Number.isInteger(row[j])) {
                        throw new Error('Matriz inválida, elemento não numérico identificado')
                    }
                }
            }
            return {
                isValid: true,
                error: false
            }
        } catch (err) {
            return {
                isValid: false,
                error: err.message
            }
        }
    }

    generateRandomMatrix(matrixSize = false) {
        if (!matrixSize) return Error('Parâmetro obrigatório')
        if (!Number.isInteger(matrixSize) || matrixSize <= 0) return Error('Parâmetro precisa ser numérico positivo não-nulo')
        const matrix = []
        for (let i = 0; i < matrixSize; i++) {
            const row = []
            for (let j = 0; j < matrixSize; j++) {
                row.push(Math.floor(Math.random() * 1000))
            }
            matrix.push(row)
        }
        this.matrix = matrix
    }

    setMatrix(matrix) {
        const {
            isValid,
            error
        } = this.checkIfMatrixIsValid(matrix)
        if (isValid) {
            this.matrix = matrix
            return
        }
        return new Error(error)
    }

    getDiffBetweenDiagonals() {
        this.leftDiagonalSum = 0
        this.rightDiagonalSum = 0
        for (let i = 0; i < this.matrix.length; i++) {
            this.leftDiagonalSum += this.matrix[i][i]
            this.rightDiagonalSum += this.matrix[i][this.matrix.length - i - 1]
        }
        this.diffBetweenDiagonals = this.leftDiagonalSum - this.rightDiagonalSum
        return this.diffBetweenDiagonals
    }
}
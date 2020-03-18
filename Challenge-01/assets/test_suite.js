const test = [
  {
    matrix: [
      [1, 2], // Pri = 5
      [3, 4] // Sec = 5
    ],
    result: 0 // 5 - 5 = 0
  },
  {
    matrix: [
      [3, 7, 2], // Pri = 13
      [7, 8, 9],
      [5, 1, 2] // Sec = 15
    ],
    result: -2 // 13 - 15 = -2
  },
  {
    matrix: [
      [5, 8, 4], // Pri = 16
      [1, 2, 9],
      [5, 1, 9] // Sec = 11
    ],
    result: 5 // 16 - 11 = 5
  },
  {
    matrix: [
      [1, 4, 4], // Pri = 6
      [5, 2, 4],
      [6, 6, 3] // Sec = 12
    ],
    result: -6 // 6 - 12 = -6
  },
  {
    matrix: [
      [1, 1, 1], // Pri = 3
      [1, 1, 1],
      [1, 1, 1] // Sec = 3
    ],
    result: 0 // 3 - 3 = 0
  },
  {
    matrix: [
      [1, 5, 6, 6], // Pri = 10
      [7, 2, 7, 4],
      [6, 8, 3, 3],
      [9, 1, 1, 4] // Sec = 30
    ],
    result: -20 // 10 - 30 = -20
  },
  {
    matrix: [
      [83, 48, 52, 76], // Pri = 194
      [42, 53, 32, 18],
      [49, 82, 15, 23],
      [13, 99, 18, 43] // Sec = 203
    ],
    result: -9 // 194 - 203 = -9
  },
  {
    matrix: [
      [3, 1, 1, 1, 1, 1, 2], // Pri = 23
      [1, 3, 1, 1, 1, 2, 1],
      [1, 1, 3, 1, 2, 1, 1],
      [1, 1, 1, 5, 1, 1, 1],
      [1, 1, 2, 1, 3, 1, 1],
      [1, 2, 1, 1, 1, 3, 1],
      [2, 1, 1, 1, 1, 1, 3] // Sec = 17
    ],
    result: 6 // 23 - 17 = 6
  },
  {
    matrix: [
      [1, 1, 1],
      [1, 1, 1],
      [1, 1, 1],
      [1, 1, 1]
    ],
    result: null // Matriz não quadrada
  },
  {
    matrix: [
      [1, 1, 1, 1],
      [1, 1, 1, 1],
      [1, 1, 1, 1]
    ],
    result: null // Matriz não quadrada
  },
  {
    matrix: [
      [1, 1, null],
      [1, 'a', 1],
      [1, 1, 1]
    ],
    result: null // Matriz contendo valores não numéricos
  },
  {
    matrix: 1,
    result: null // Não é uma matriz
  }
];

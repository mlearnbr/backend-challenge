const express = require('express');

const controllers = require('../controllers');

// rota: '/users'
const userRouter = express.Router();
userRouter.post('/', controllers.UserController.register);
userRouter.get('/', controllers.UserController.findAll); 

module.exports = {
    userRouter,
};
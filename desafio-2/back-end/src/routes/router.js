const express = require('express');

const controllers = require('../controllers');

// rota: '/user'
const userRouter = express.Router();
userRouter.post('/', controllers.UserController.register);
userRouter.get('/', controllers.UserController.findAll);
userRouter.put('/:id/upgrade/', controllers.UserController.upgrade);
userRouter.put('/:id/downgrade/', controllers.UserController.downgrade);

module.exports = {
    userRouter,
};
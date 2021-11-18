/* eslint-disable camelcase */
const rescue = require('express-rescue');
const Joi = require('joi');
const UserService = require('../services/UserService');
const { validate } = require('../middlewares');
const postUsersMLearnApi = require('../api/apiMLearn');

const register = [
    validate(Joi.object({
        msisdn: Joi.string().length(14).regex(/^['+']/).required(),
        name: Joi.string().required(),
        access_level: Joi.string().required(),
        password: Joi.string(),
        external_id: Joi.string().required(),
    })),
    rescue(async (req, res) => {
        const { body } = req;
        const user = await UserService.register(body);
        
        if (user.error) return res.status(409).json(user.error);

        await postUsersMLearnApi();
        return res.status(201).json(user);
    }),
];

const findAll = rescue(async (_req, res) => {
    const users = await UserService.findAll();
    return res.status(200).json(users);
});

module.exports = {
    register,
    findAll,
};
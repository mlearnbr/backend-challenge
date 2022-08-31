/* eslint-disable camelcase */
const rescue = require('express-rescue');
const Joi = require('joi');
const UserService = require('../services/UserService');
const { validate } = require('../middlewares');
const { downgradeUsersMLearnApi, upgradeUsersMLearnApi,
    postUsersMLearnApi } = require('../api/apiMLearn');

const register = [
    validate(Joi.object({
        msisdn: Joi.string().length(14).regex(/^['+']/).required(),
        name: Joi.string().required(),
        access_level: Joi.string().required(),
        password: Joi.string(),
        external_id: Joi.string().required(),
    })),
    rescue(async (req, res) => {
        const { body: data } = req;
        const user = await UserService.register(data);
        
        if (user.error) return res.status(409).json(user.error);

        await postUsersMLearnApi(data);
        return res.status(201).json(user);
    }),
];

const findAll = rescue(async (_req, res) => {
    const users = await UserService.findAll();
    return res.status(200).json(users);
});

const upgrade = rescue(async (req, res) => {
    const { id } = req.params;
    const user = await UserService.upgrade(id);
    if (user.error) return res.status(404).json(user.error);
    await upgradeUsersMLearnApi(id);
    return res.status(200).json(user);
});

const downgrade = rescue(async (req, res) => {
    const { id } = req.params;
    const user = await UserService.downgrade(id);
    if (user.error) return res.status(404).json(user.error);
    await downgradeUsersMLearnApi(id);
    return res.status(200).json(user);
});

module.exports = {
    register,
    findAll,
    upgrade,
    downgrade,
};
/* eslint-disable camelcase */
const UserModel = require('../model/UsersModel');

const register = async (body) => {
    const user = await UserModel.register(body);
    if (user === null) {
        return { error: { message: 'Usuário já cadastrado' } };
    }

    const { _id: id, msisdn, access_level, name, created_at } = user;
    return {
        data: {
            id,
            service_id: 'ServiceId',
            msisdn,
            access_level,
            name,
            score: 0,
            level: 1,
            created_at,
            relatives: [],
        },
    };
};

const findAll = async () => {
    const users = await UserModel.findAll();
    const { password: _, ...userWithoutPassword } = users;
    return userWithoutPassword;
};

const upgrade = async (userId) => {
    const user = await UserModel.upgrade(userId);

    if (user === null) {
        return { error: { message: 'Usuário não encontrado' } };
    }

    return {
        data: {
            id: userId,
            service_id: process.env.SERVICE_ID,
        },
    };
};

const downgrade = async (userId) => {
    const user = await UserModel.downgrade(userId);

    if (user === null) {
        return { error: { message: 'Usuário não encontrado' } };
    }

    return {
        data: {
            id: userId,
            service_id: process.env.SERVICE_ID,
        },
    };
};

module.exports = {
    register,
    findAll,
    upgrade,
    downgrade,
};
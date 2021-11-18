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
    return users;
};

module.exports = {
    register,
    findAll,
};
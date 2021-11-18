/* eslint-disable camelcase */
const { ObjectId } = require('mongodb');
const downgradeAccessLevel = require('../utils/downgradeAccessLevel');
const upgradeAccessLevel = require('../utils/upgradeAccessLevel');
const connection = require('./connection');

const findByexternalId = async (externalId) => {
    const db = await connection();
    return db.collection('users').findOne({ external_id: externalId });
};

const findByPhoneNumber = async (msisdn) => {
    const db = await connection();
    return db.collection('users').findOne({ msisdn });
};

const findById = async (userId) => {
    if (!ObjectId.isValid(userId)) return null;
    const db = await connection();
    return db.collection('users').findOne(ObjectId(userId));
};

const register = async (body) => {
    const { msisdn, name, access_level, password, external_id } = body;
    const user = await findByexternalId(external_id);
    if (user !== null) return null;

    const db = await connection();
    const users = await db.collection('users')
        .insertOne({
            msisdn,
            name,
            access_level,
            password,
            external_id,
            created_at: new Date().toISOString(),
        });

    return findById(users.insertedId.toString());
};

const findAll = async () => {
    const db = await connection();
    return db.collection('users').find().toArray();
};

const upgradeDowngrade = async (userId, upgradeOrDowngrade) => {
    const user = await findById(userId);

    let newAccessLevel = '';
    if (user === null) return null; // 'Usuário não encontrado'

    const { access_level } = user;

    if (upgradeOrDowngrade === 'upgrade') {
        newAccessLevel = upgradeAccessLevel(access_level);
    }

    if (upgradeOrDowngrade === 'downgrade') {
        newAccessLevel = downgradeAccessLevel(access_level);
    } 
    
    const db = await connection();
    return db.collection('users')
        .updateOne({ _id: userId }, { $set: { access_level: newAccessLevel } });
};

const upgrade = async (userId) => upgradeDowngrade(userId, 'upgrade');
const downgrade = async (userId) => upgradeDowngrade(userId, 'downgrade');

module.exports = {
    findByexternalId,
    findByPhoneNumber,
    register,
    findAll,
    findById,
    upgrade,
    downgrade,
};
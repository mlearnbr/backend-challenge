require('dotenv').config();
const axios = require('axios');
const { UserController } = require('../controllers');

const token = process.env.TOKEN;
const serviceId = process.env.SERVICE_ID;

const apiMLearn = axios.create({ baseURL: 'https://api.mlearn.mobi/' });

const config = { headers: { Authorization: `Bearer ${token}` } };

// cadastrando usuarios na base da mLearn
const postUsersMLearnApi = async () => apiMLearn
    .post(`integrator/${serviceId}/users`, UserController.register, config);

module.exports = postUsersMLearnApi;
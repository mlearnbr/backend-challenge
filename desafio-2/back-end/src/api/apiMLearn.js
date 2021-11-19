require('dotenv').config();
const axios = require('axios');

const token = process.env.TOKEN;
const serviceId = process.env.SERVICE_ID;
const baseURL = 'https://api.mlearn.mobi';
const config = { headers: { Authorization: `Bearer ${token}` } };

// cadastrando usuarios na base da mLearn
const postUsersMLearnApi = async (data) => {
    axios({
        method: 'post',
        url: `${baseURL}/integrator/${serviceId}/users`,
        data,
        config,
    }).then(console.log).catch(console.log);
};

const upgradeUsersMLearnApi = async (id) => {
    axios({
        method: 'put',
        url: `${baseURL}/integrator/${serviceId}/users/user-${id}/upgrade`,
        config,
    }).then(console.log).catch(console.log);
};

const downgradeUsersMLearnApi = async (id) => {
    axios({
        method: 'put',
        url: `${baseURL}/integrator/${serviceId}/users/user-${id}/downgrade`,
        config,
    }).then(console.log).catch(console.log);
};

module.exports = {
    postUsersMLearnApi,
    upgradeUsersMLearnApi,
    downgradeUsersMLearnApi,
};
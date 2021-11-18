const upgradeAccessLevel = (accessLevel) => {
    let newAccessLevel = 'premium';

    if (accessLevel === 'free') {
        newAccessLevel = 'pro';
    }

    if (accessLevel === 'pro') {
        newAccessLevel = 'premium';
    }

    return newAccessLevel;
};

module.exports = upgradeAccessLevel;
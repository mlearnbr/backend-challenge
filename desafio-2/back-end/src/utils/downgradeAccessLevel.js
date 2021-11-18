const downgradeAccessLevel = (accessLevel) => {
    let newAccessLevel = 'free';

    if (accessLevel === 'premium') {
        newAccessLevel = 'pro';
    }

    if (accessLevel === 'pro') {
        newAccessLevel = 'free';
    }

    return newAccessLevel;
};

module.exports = downgradeAccessLevel;
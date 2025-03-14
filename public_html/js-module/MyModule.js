'esversion:6'
export const message = () => {
    const name = "Jesse";
    const age = 40;
    return name + ' is ' + age + ' years old.';
};

export const getCurrentTime = () => {
    const now = new Date();
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const seconds = String(now.getSeconds()).padStart(2, '0');
    const result = `${hours}:${minutes}:${seconds}`;

    return result;
};
import * as api from '../constants/api';

export const currentUser = async () => {
  const { data: { data } } = await axios.get(api.API_CURRENT_USER);

  return data;
};

export const login = async (login, password) => {
  const { data: { data } } = await axios.post(api.API_LOGIN, {
    email: login, password,
  });

  return data;
};

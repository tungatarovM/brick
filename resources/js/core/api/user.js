import * as api from '../constants/api';
import User from "../entities/User";

export const currentUser = async () => {
  const { data: { data } } = await axios.get(api.API_CURRENT_USER);

  return new User(data);
};

export const login = async (login, password) => {
  const { data: { data } } = await axios.post(api.API_LOGIN, {
    email: login, password,
  });

  return data;
};

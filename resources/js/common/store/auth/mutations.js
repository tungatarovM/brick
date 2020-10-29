import forEach from 'lodash/forEach';
import User from "../../../core/entities/User";

export default {
  setUser: (state, user) => {
    forEach(User.fillable, (field) => {
      state[field] = user[field];
    });
  },
  clear: (state) => {
    forEach(User.fillable, (field) => {
      state[field] = '';
    });
  },
}

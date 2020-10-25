import forEach from 'lodash/forEach';

const fields = [
  'name', 'email', 'organizationId',
  'organizationName', 'avatar', 'shift', 'breaks',
];

export default {
  setUser: (state, payload) => {
    forEach(fields, (field) => {
      state[field] = payload[field];
    });
  },
  clear: (state) => {
    forEach(fields, (field) => {
      state[field] = '';
    });
  },
}

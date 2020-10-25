import reduce from 'lodash/reduce';

export const parseErrors = (response) => {
  return reduce(response.data.errors, (acc, errors, fieldName) => {
    return {
      [fieldName]: errors[0],
    }
  }, {});
};

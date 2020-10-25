import forEach from 'lodash/forEach';
import * as messages from './constants/validator';

const required = (fieldValue) => {
  return fieldValue !== null && fieldValue !== undefined && fieldValue.length;
}

const validators = {
  required,
}

const format = (rule) => {
  const formatted = rule.split(':');
  const ruleName = formatted.length > 1 ? formatted[0] : rule;
  const ruleValue = formatted.length > 1 ? formatted[1] : null;

  return { ruleName, ruleValue };
}

export default (fields, rules) => {
  const attributes = {};
  const errors = {};
  let isValid = true;

  forEach(fields, (field) => {
    const { name: fieldName, value: fieldValue } = field;
    const fieldRules = rules[fieldName].split('|');

    forEach(fieldRules, (fieldRule) => {
      const { ruleName, ruleValue } = format(fieldRule);

      const validator = validators[ruleName];

      if (!validator(fieldValue, ruleValue)) {
        isValid = false;
        errors[fieldName] = messages[ruleName];
      } else {
        attributes[fieldName] = fieldValue;
      }
    });
  });

  return { attributes, errors, isValid };
}

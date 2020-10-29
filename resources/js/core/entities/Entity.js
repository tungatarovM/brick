import isEmpty from 'lodash/isEmpty';

export default class Entity {
  toJson(jsonable) {
    if (!isEmpty(jsonable)) {
      throw new Error('Jsonable values should not be empty');
    }
    return JSON.stringify({ test: 'test'});
  }
}

import Entity from "./Entity";

const jsonable = [
  'id', 'name', 'email', 'avatar', 'position',
  'status', 'shift', 'breaks',
];

const fillable = [
  'name', 'email', 'organizationId',
  'organizationName', 'avatar', 'shift', 'breaks',
];

export default class User extends Entity {
  constructor(user) {
    super();
    this.id = user.id;
    this.name = user.name;
    this.email = user.email;
    this.avatar = user.avatar;
    this.position = user.position;
    this.status = user.status;
    this.organizationId = user.organizationId;
    this.organizationName = user.organizationName;
    this.shift = user.shift;
    this.breaks = user.breaks;
  }

  static fillable = fillable;

  static jsonable = jsonable;

  static collection(userCollection) {
    return userCollection.map((userData) => new User(userData));
  }
}

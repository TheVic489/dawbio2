export class User {
  username: string | null;
  password: string | null;
  role: string | null;
  email: string | null;
  civilStatus: string | null;
  gender: string | null;
  info: string | null;
  conditions: boolean;

  constructor(
    username: string | null,
    password: string | null,
    role: string | null,
    email: string | null,
    civilStatus: string | null,
    gender: string | null,
    info: string | null,
    conditions: boolean
  ) {
    this.username = username;
    this.password = password;
    this.role = role;
    this.email = email;
    this.civilStatus = civilStatus;
    this.gender = gender;
    this.info = info;
    this.conditions = conditions;
  }

  

}

export interface IUser {
  id: number;
  user_type_id: number;
  name: string;
  email: string;
  password?: string;
  status: number;
  last_login?: Date;
  created_at?: Date;
  updated_at?: Date;
  deleted_at?: Date;
}

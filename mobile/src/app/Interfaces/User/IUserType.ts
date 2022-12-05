export interface IUserType {
  id: number;
  name: string;
  status: number;
  userType?: IUserType;
  created_at: Date;
  updated_at: Date;
  deleted_at: Date;
}

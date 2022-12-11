export interface IUserType {
  id: number;
  name: string;
  status: number;
  type?: string;
  created_at: Date;
  updated_at: Date;
  deleted_at: Date;
}

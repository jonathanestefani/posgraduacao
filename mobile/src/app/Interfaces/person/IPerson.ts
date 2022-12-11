export interface IPerson {
  id: number;
  city_id?: number;
  state_id?: number;
  country_id?: number;
  name?: string;
  type?: string;
  cnpj_cpf?: string;
  street?: string;
  neighborhood?: string;
  zip_code?: string;
  number?: string;
  complement?: string;
  phone?: string;
  email?: string;
  status?: number;
  created_at?: Date;
  updated_at?: Date;
  deleted_at?: Date;
}

select
    CONCAT(
        'insert into customers (city_id, state_id, country_id, name, type, cnpj_cpf, street, neighborhood, zip_code, number, complement, phone, email, status) 
		 values (',IFNULL(pa.city_id,''),',',IFNULL(pa.state_id,''),',',IFNULL(pa.country_id,''),',\'',IFNULL(pa.name,'\'\''),'\',\'',IFNULL(pa.type,'\'\''),'\',\'',IFNULL(pa.cnpj_cpf,'\'\''),'\',\'',IFNULL(pa.street,'\'\''),'\',\'',IFNULL(pa.neighborhood,'\'\''),'\',',IFNULL(pa.zip_code,''),',',IFNULL(pa.number,''),',\'',IFNULL(pa.complement,'\'\''),'\',\'',IFNULL(pa.phone,'\'\''),'\',\'',IFNULL(pa.email,'\'\''),'\',',IFNULL(pa.status,''),');'
	) as script
from payers pa 
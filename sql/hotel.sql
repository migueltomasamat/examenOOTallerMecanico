DELIMITER //
drop table if exists service cascade;
drop table if exists hotel cascade;

create table hotel(
    hoteluuid VARCHAR(36),
    hotelrooms INT,
    hotelcategory INT,
    hotelavailablerooms INT,
    hotelprice DECIMAL(7, 2)
)
//

alter table hotel add constraint pk_hotel primary key (hoteluuid);
/*
alter table hotel add constraint fk_hotel_client foreign key (hoteluuid) references client(clientuuid);
alter table hotel enable keys fk_hotel_client;
alter table hotel disable keys fk_hotel_client;
*/
//
create table service(
    serviceid BIGINT AUTO_INCREMENT PRIMARY KEY,
    servicename VARCHAR(100),
    hoteluuid VARCHAR(36)
);
//

alter table service add constraint fk_hotel_service foreign key (hoteluuid) references hotel(hoteluuid) on delete cascade;
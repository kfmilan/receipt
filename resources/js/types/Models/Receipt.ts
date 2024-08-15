export interface Receipt extends Timestamps {
    id: number;
    name: string;
    date: string;
    service_charge_rate: number;
}

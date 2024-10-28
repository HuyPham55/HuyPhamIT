export declare type PaginationType = {
    current_page: number;
    from: number;
    last_page: number;
    per_page: number;
    to: number;
    total: number;
    links?: PaginationLink[];
}

export declare type PaginationLink = {
    url?: string;
    label?: string;
    active: boolean;
}

export declare type PaginationLinkArray = {
    first: string;
    last: string;
    prev: string;
    next: string;
}

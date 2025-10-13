export declare type CommentAuthor = {
    name: string;
    profile_picture: string;
}
export declare type CommentType = {
    id: any;
    content: string;
    author: CommentAuthor;
    created_at: string;
    created_at_human: string;
    created_at_relative: string;
}
